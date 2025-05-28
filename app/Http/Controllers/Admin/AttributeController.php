<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Capacity;

class AttributeController extends Controller
{
    protected function getModel($type)
    {
        return match ($type) {
            'colors' => Color::class,
            'capacities' => Capacity::class,
            default => abort(404),
        };
    }

 protected function getViewData($type)
{
    return match ($type) {
        'colors' => [
            'title' => 'Màu sắc',
            'fields' => [
                'name' => 'Tên màu',
                // Nếu có thêm mã màu thì thêm vào đây:
                // 'code' => 'Mã màu',
            ],
        ],
        'capacities' => [
            'title' => 'Dung lượng',
            'fields' => [
                'name' => 'Giá trị', // ✅ Sửa 'value' => ... thành 'name' => ...
            ],
        ],
        default => abort(404),
    };
}


  public function index($type)
{
    $model = $this->getModel($type);
    $items = $model::all();

    // Thiết lập $viewData tùy theo $type
    $viewData = $this->getViewData($type);

    // Đảm bảo $viewData['fields'] có chứa các cột cần hiển thị, ví dụ:
    // Nếu getViewData chưa chuẩn, bạn có thể khai báo trực tiếp như sau:

    $fields = [
        'id' => 'ID',
        'name' => 'Tên thuộc tính',
    ];

    if ($type === 'color') {
        $viewData = [
            'title' => 'Màu sắc',
            'fields' => $fields,
        ];
    } elseif ($type === 'capacity') {
        $viewData = [
            'title' => 'Dung lượng',
            'fields' => $fields,
        ];
    } else {
        $viewData = [
            'title' => 'Thuộc tính',
            'fields' => $fields,
        ];
    }


    return view('admin.attributes.index', compact('items', 'type', 'viewData'));
}


    public function create($type)
    {
        $viewData = $this->getViewData($type);
        return view('admin.attributes.create', compact('type', 'viewData'));
    }

    public function store(Request $request, $type)
    {
        $model = $this->getModel($type);
        $data = $request->validate([
        'name' => 'required|string|max:255',
    ]);
        $model::create($data);
        return redirect()->route('attributes.index', $type)->with('success', 'Thêm thành công!');
    }

    public function edit($type, $id)
    {
        $model = $this->getModel($type);
        $item = $model::findOrFail($id);
        $viewData = $this->getViewData($type);
        return view('admin.attributes.edit', compact('type', 'item', 'viewData'));
    }

  public function update(Request $request, $type, $id)
{
    $model = $this->getModel($type);
    $item = $model::findOrFail($id);

    $data = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $item->update($data);

    return redirect()->route('attributes.index', $type)->with('success', 'Cập nhật thành công!');
}


    public function destroy($type, $id)
    {
        $model = $this->getModel($type);
        $item = $model::findOrFail($id);
        $item->delete();
        return redirect()->route('attributes.index', $type)->with('success', 'Xóa thành công!');
    }
}
