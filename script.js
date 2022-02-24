function AddCart(body)
{
    const xhr = new XMLHttpRequest();
    xhr.open('POST','add.php',body);
    xhr.responseType = 'json';
    xhr.setRequestHeader('Content-Type','application/json');

    xhr.onload = () =>
    {
        if(xhr.status == 200)
        {
            
        }
    }

}