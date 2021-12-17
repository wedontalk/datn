<thead>
    <tr>
        <th class="serial">#</th>
        <th class="serial">Tên dịch vụ</th>
        <th>Trạng thái</th>
        <th style="width:100px;">Action</th>
        <!-- <th>Quantity</th> -->
        <!-- <th>Status</th> -->
    </tr>
</thead>
<tbody>
    @php
    $i = 1;
    @endphp
    @foreach($data as $dt)
        <tr>
            <td class="serial">{{$i++}}</td>
            <td class="edit_name" contenteditable data-id='{{$dt['id']}}' style="width:800px">
                <span>{{$dt['name_dichvu']}}</span>
            </td>
            <td>
                @if($dt['id_status'] == 1)
                    <span class="badge badge-complete">thành công</span>
                @elseif ($dt['id_status'] == 2)
                    <span class="badge badge-warning">đợi xét duyệt</span>
                @else
                    <span class="badge badge-danger">đã hủy</span>
                @endif
            </td>
            <td>
                <a href="{{route('chitietdichvu.destroy',$dt['id'])}}" class="btn btn-sm btn-danger btndelete"><i class="fa fa-trash"></i> Xóa</a>
            </td>
        </tr>
    @endforeach
</tbody>