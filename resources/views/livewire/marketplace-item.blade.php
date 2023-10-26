<div id="{{"Item".$id}}" class="flex items-center">
        <div class="w-10 text-center">
        </div>
        <div class="flex-grow overflow-hidden whitespace-nowrap truncate">
            {{$index+1}}. {{$Name}}
</div>
<div class="w-10 text-center">
 <i onclick="SelectedRowUpdate = {{$id}};updateTable({{$id}})" onclick="my_modal_3.showModal();" class='cursor-pointer text-3xl bx bx-edit-alt'></i>
</div>
<div class="w-10 text-center">
 <i onclick="ItemID = {{$id}};OpenModal2();" class='cursor-pointer text-red-600 text-3xl bx bx-x'></i>
</div>
</div>
