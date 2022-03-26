var buffer_editor_text;
var buffer_editor_name;
var buffer_editor_category;
var buffer_editor_stage;
const xhr = new XMLHttpRequest();

function RequestForCard(login, stage)
{
    var dname = document.getElementById('add_name_'+stage).value;

    if(dname == "") return false;
    var dtext = document.getElementById('add_text_'+stage).value;

    var dcategory = document.getElementById('category_'+stage).value;

    if(xhr.readyState != 0 && xhr.readyState != 4) return false;
 
    xhr.open('POST','Request/add.php',true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            AddCard(dname,dtext, xhr.responseText, login, dcategory, stage);
        }
        else{
            alert(xhr.status);
        }
    }

    xhr.send("name="+dname+"&text="+dtext+"&login="+login+"&category="+dcategory+"&stage="+stage);

}
function DeleteCard(id)
{

    if(xhr.readyState != 0 && xhr.readyState != 4) return false;

    xhr.open('POST','Request/delete.php',true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            (document.getElementById(id)).remove();
        }
        else{
            alert(xhr.status);
        }
    }

    xhr.send("id="+id);
}
function EditCard(id, table)
{
    xhr.open('GET','Request/category.php',true);

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            var response = xhr.responseText.split("&");
            var option = response[0].split("+");
            var stage = response[1].split("+");
            var stages = "";
            var options = "";

            buffer_editor_category = document.getElementById("category_"+id).innerText;
            buffer_editor_stage = table;

            option.forEach(element => {
                if(element == buffer_editor_category)
                    options += `<option selected value='`+element+`'>`+element+`</option>`;
                else
                    options += `<option value='`+element+`'>`+element+`</option>`;
            });
            stage.forEach(element => {
                if(element == buffer_editor_stage)
                    stages += "<option selected value='"+element+"'>"+element+"</option>";
                else
                    stages += "<option value='"+element+"'>"+element+"</option>";
            });
            

            var header = document.getElementById('name_'+ id);
            buffer_editor_name = header.innerText;
            header.innerHTML="<input type='text' id='editor_name_"+id+"' style='max-width: min-content' value=\'"+buffer_editor_name+"\'>";
            var area = document.getElementById("text_"+id);
            buffer_editor_text = area.value;
            area.readOnly = false;
           
            var categoryArea = document.getElementById("category_area_"+id);
            categoryArea.innerHTML = `<select class='form-select w-50 form-select-sm mx-auto mb-2' name='category' id='category_editor_${id}'>`+options+`</select>`+
                                     `<select class='form-select w-50 form-select-sm mx-auto mb-2' name='stage' id='stage_editor_${id}'>`+stages+`</select>`;

            

            var btn_ed = document.getElementById("btn_ed_"+id);
            btn_ed.value = "Cancel";
            btn_ed.onclick = CancelEdit.bind(this,id);

            var btn_de = document.getElementById("btn_de_"+id);
            btn_de.value = "Confirm";
            btn_de.onclick = ConfirmEdit.bind(this,id);
        }
        else{
            alert(xhr.status);
        }
    }
    xhr.send();  
}

function CancelEdit(id)
{
    header = document.getElementById('name_'+id);
    header.innerHTML = buffer_editor_name;
    var area = document.getElementById("text_"+id);
    area.value = buffer_editor_text;
    area.readOnly = true;

    var categoryArea = document.getElementById("category_area_"+id);
    categoryArea.innerHTML = `<p id=category_${id}>${buffer_editor_category}</p>`;


    var btn_ed = document.getElementById("btn_ed_"+id);
    btn_ed.value = "Edit";
    btn_ed.onclick = EditCard.bind(this,id, buffer_editor_stage);

    var btn_de = document.getElementById("btn_de_"+id);
    btn_de.value = "Delete";
    btn_de.onclick = DeleteCard.bind(this,id);
    
}
function ConfirmEdit(id)
{
    var dname = document.getElementById('editor_name_'+id).value;
    if(dname == "") return false;
    var dtext = document.getElementById("text_"+id).value;

    var category = document.getElementById("category_editor_"+id).value;
    var stage = document.getElementById("stage_editor_"+id).value;

    if(xhr.readyState != 0 && xhr.readyState != 4) return false;

    xhr.open('POST','Request/edit.php',true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            buffer_editor_name = dname;
            buffer_editor_text = dtext;
            buffer_editor_category = category;
            if(buffer_editor_stage != stage)
            {
                buffer_editor_stage = stage;
                document.getElementById("parent_div_"+stage).appendChild(document.getElementById(id));
            }
            CancelEdit(id);
        }
        else{
            alert(xhr.status);
        }
    }

    xhr.send("name="+dname+"&text="+dtext+"&id="+id+"&category="+category+"&stage="+stage);
}


function AddCard(name, text, id, login, category, stage)
{

    var adder = document.getElementById("adder_card_"+stage);
    adder.remove();

    var parent = document.getElementById("parent_div_"+stage);
    parent.innerHTML += "<div class='col' id='"+id+"'>"+
                        "<div class='card shadow-sm'>" +
                        "<div class='card-header' role='tab' id='headingOne'>" +
                        "<div class='d-flex justify-content-between align-items-center'>" +
                        "<h5 class='mb-0' style='width: 70%' id='name_"+id+"'>"+name+"</h5>" +
                        "<div class='btn-group'>" +
                        `<input type='button' id='btn_ed_`+id+`' value='Edit' onclick='EditCard("${id}","${stage}")' class='btn btn-sm btn-outline-secondary'>` +
                        "<input type='button' id='btn_de_"+id+"' value='Delete' name='del' onclick='DeleteCard("+id+")' class='btn btn-sm btn-outline-secondary'>" +
                        "</div></div></div>"+
                        "<div class='card-body'><p>"+category+"</p>"+
                        "<textarea class='form-control ' id='text_"+id+"' rows='3' style='resize: none' readonly>"+text+"</textarea></div></div></div>";
    AddAdderCard(login,stage);
}


function AddAdderCard(login,stage)
{
    xhr.open('GET','Request/category.php',true);

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {

            var option = xhr.responseText.split("&")[0].split("+");
            var options = "";
            option.forEach(element => {
                options += "<option value='"+element+"'>"+element+"</option>"
            });

            var parent = document.getElementById("parent_div_"+stage);
            parent.innerHTML += "<div class='col' id='adder_card_"+stage+"'>" +
                        "<div class='card shadow-sm'>" +
                        "<div class='card-header' role='tab' id='headingOne'>" +
                        "<div class='d-flex justify-content-between align-items-center'>" +
                        "<h5 class='mb-0' style='width: 70%'>" +
                        "<input type='text' name='name' id='add_name_"+stage+"' style='max-width: 65%'> </h5>" +
                        "<div class='btn-group'>" +
                        `<input type='button' name='add' onclick='RequestForCard(\"${login}\",\"${stage}\")' value='Add' class='btn btn-sm btn-outline-secondary'>` +
                        "</div></div></div>" +
                        "<div class='card-body'>" +
                        "<select class='form-select w-50 form-select-sm mx-auto mb-2' name='category' id='category_"+stage+"' id=''>" +
                        options +
                        "</select>" +
                        "<textarea class='form-control' name='desc' id='add_text_"+stage+"' rows='3' style='resize: none;'></textarea>" +
                        "</div></div></div>";
        }
        else{
            alert(xhr.status);
        }
    }
    xhr.send();  
}

function AddRow(parent, name)
{
    var table = document.getElementById(parent+"_body");
    table.innerHTML += `<tr id='${parent}_${name}'>` + 
                       `<th scope='row' id='${name}'>${name}</th>` +
                       `<td><button id='del__${name}' type='button' class='btn btn-info' onclick='Delete${parent}(${name})'>Удалить</button></td></tr>`;
}

function DeleteRow(parent,name)
{
    var row = document.getElementById(parent+"_"+name);
    row.remove();
}

function AddCategory()
{
    var name = document.getElementById('name_adder_category').value;
    if(name == "") return;
    xhr.open('POST','Request/CategoryRequest.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            if(xhr.responseText == "ok")
            {
                AddRow('Category',name);
            }
            else
            {
                alert(xhr.responseText);
            }
        }
        else
        {
            alert(xhr.status);
        }
    }
    xhr.send("choice=add"+"&new="+name);
}

function AddStage()
{
    var name = document.getElementById('name_adder_stage').value;
    if(name == "") return;
    xhr.open('POST','Request/StageRequest.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            if(xhr.responseText == "ok")
            {
                AddRow('Stage',name);
            }
            else
            {
                alert(xhr.responseText);
            }
        }
        else
        {
            alert(xhr.status);
        }
    }
    xhr.send("choice=add"+"&new="+name);
}

function DeleteCategory(name)
{
    xhr.open('POST','Request/CategoryRequest.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            if(xhr.responseText == "ok")
            {
                DeleteRow('Category',name);
            }
            else
            {
                alert(`Удалить \'${name}\' невозможно: Данная категория используется.`);
            }
        }
        else{
            alert(xhr.status);
        }
    }
    xhr.send("choice=del"+"&name="+name);
}

function DeleteStage(name)
{
    xhr.open('POST','Request/StageRequest.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            if(xhr.responseText == "ok")
            {
                DeleteRow('Stage',name);
            }
            else
            {
                alert(`Удалить \'${name}\' невозможно: Данная категория используется.`);
            }
        }
        else{
            alert(xhr.status);
        }
    }
    xhr.send("choice=del"+"&name="+name);
}

