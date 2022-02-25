var buffer_editor_text;
var buffer_editor_name;
const xhr = new XMLHttpRequest();

function RequestForCard(login)
{
    var dname = document.getElementById('add_name').value;

    if(dname == "") return false;
    var dtext = document.getElementById('add_text').value;

    if(xhr.readyState != 0 && xhr.readyState != 4) return false;

    xhr.open('POST','add.php',true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            AddCard(dname,dtext, xhr.responseText, login);
        }
        else{
            alert(xhr.status);
        }
    }

    xhr.send("name="+dname+"&text="+dtext+"&login="+login);

}
function DeleteCard(id)
{

    if(xhr.readyState != 0 && xhr.readyState != 4) return false;

    xhr.open('POST','delete.php',true);
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
function EditCard(id)
{
    var header = document.getElementById('name_'+ id);
    buffer_editor_name = header.innerText;
    header.innerHTML="<input type='text' id='editor_name' value="+buffer_editor_name+">";
    var area = document.getElementById("text_"+id);
    buffer_editor_text = area.value;
    area.readOnly = false;

    var btn_ed = document.getElementById("btn_ed_"+id);
    btn_ed.value = "Cancel";
    btn_ed.onclick = CancelEdit.bind(this,id);

    var btn_de = document.getElementById("btn_de_"+id);
    btn_de.value = "Confirm";
    btn_de.onclick = ConfirmEdit.bind(this,id);
}

function CancelEdit(id)
{
    header = document.getElementById('name_'+id);
    header.innerHTML = buffer_editor_name;
    var area = document.getElementById("text_"+id);
    area.value = buffer_editor_text;
    area.readOnly = true;

    var btn_ed = document.getElementById("btn_ed_"+id);
    btn_ed.value = "Edit";
    btn_ed.onclick = EditCard.bind(this,id);

    var btn_de = document.getElementById("btn_de_"+id);
    btn_de.value = "Delete";
    btn_de.onclick = DeleteCard.bind(this,id);
    
}
function ConfirmEdit(id)
{

    var dname = document.getElementById('editor_name').value;
    if(dname == "") return false;
    var dtext = document.getElementById("text_"+id).value;

    if(xhr.readyState != 0 && xhr.readyState != 4) return false;

    xhr.open('POST','edit.php',true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            buffer_editor_name = dname;
            buffer_editor_text = dtext;
            CancelEdit(id);
        }
        else{
            alert(xhr.status);
        }
    }

    xhr.send("name="+dname+"&text="+dtext+"&id="+id);
}


function AddCard(name, text, id, login)
{

    var adder = document.getElementById("adder_card");
    adder.remove();

    var parent = document.getElementById("parent_div");
    
    var column = document.createElement("div");
    parent.appendChild(column);
    column.className = "col";
    column.setAttribute("id",id);


    var card = document.createElement("div");
    column.appendChild(card);
    card.className = "card shadow-sm";
    
    var header = document.createElement("div");
    card.appendChild(header);
    header.className = "card-header";
    
    var flex = document.createElement("div");
    header.appendChild(flex);
    flex.className = "d-flex justify-content-between align-items-center";

    var headername = document.createElement("h5");
    flex.appendChild(headername);
    headername.className = "mb-0";
    headername.innerText = name;
    headername.id = "name_"+id;

    var group = document.createElement("div");
    flex.appendChild(group);
    group.className = "btn-group";

    var btn = document.createElement("button");
    btn.className = "btn btn-sm btn-outline-secondary";
    group.appendChild(btn);
    btn.id = "btn_ed_"+id;
    btn.onclick = EditCard.bind(this,id);
    btn.innerText="Edit";
    btn.setAttribute("style","solor: inherit");

    var btn = document.createElement("button");
    btn.className = "btn btn-sm btn-outline-secondary";
    group.appendChild(btn);
    btn.id = "btn_de_"+id;
    btn.onclick = DeleteCard.bind(this,id);
    btn.innerText="Delete";
    btn.setAttribute("style","solor: inherit");

    var body = document.createElement("div");
    card.appendChild(body);
    body.className = "card-body";

    var area = document.createElement("textarea")
    area.readOnly = true;
    area.id = "text_"+id;
    body.appendChild(area);
    area.className="form-control";
    area.setAttribute("rows","3");
    area.setAttribute("style","resize: none");
    area.innerText = text;

    AddAdderCard(login);
}

function AddAdderCard(login)
{
    var parent = document.getElementById("parent_div");
    
    var column = document.createElement("div");
    parent.appendChild(column);
    column.className = "col";
    column.setAttribute("id",'adder_card');


    var card = document.createElement("div");
    column.appendChild(card);
    card.className = "card shadow-sm";
    
    var header = document.createElement("div");
    card.appendChild(header);
    header.className = "card-header";
    
    var flex = document.createElement("div");
    header.appendChild(flex);
    flex.className = "d-flex justify-content-between align-items-center";

    var headername = document.createElement("h5");
    flex.appendChild(headername);
    headername.className = "mb-0";
    headername.innerHTML = '<input type="text" name="name" id="add_name">';

    var group = document.createElement("div");
    flex.appendChild(group);
    group.className = "btn-group";
    group.innerHTML = "<input type='button' name='add' onclick=RequestForCard(\'"+login+"\') value='Add' class='btn btn-sm btn-outline-secondary'>";

    var body = document.createElement("div");
    card.appendChild(body);
    body.className = "card-body";
    body.innerHTML = '<textarea class="form-control" name="desc" id="add_text" rows="3" style="resize: none;"></textarea>';
}

