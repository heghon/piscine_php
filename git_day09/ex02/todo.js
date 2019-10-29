i = 0;
div = [];

function new_div()
{
    var retour = document.createTextNode(prompt("What do you want to add ?","to do, to do, to do to do to do, to do to dooooo, to do do do do"));
    if (retour.nodeValue != 'null')
    {
        var my_list=document.getElementById("ft_list");
        var new_element=document.createElement('div');
        new_element.setAttribute('onclick', "delete_div(this);");
        new_element.setAttribute('id', i);
        new_element.appendChild(retour);
        my_list.prepend(new_element);
        div[i] = retour;
        setCookies();
        i++;
    }
}

function delete_div(elem)
{
    var my_list=document.getElementById("ft_list");
    my_list.removeChild(elem);
    div.splice(elem.id, 1);
    setCookies();
}

function setCookies() {
    var str =  JSON.stringify(div);
    document.cookie = "cookies=" + str + "; expires=Sun, 27 Oct 2019 12:00:00 UTC";
}

window.onload = function()
{
    if (document.cookie)
    {
        alert("cookie !");
        var cook = document.cookie;
        var newtab = cook.split("=");
        var test = JSON.parse(newtab[1]);
        var tab = JSON.parse(document.cookie);
        for (str in tab)
        {
            var my_list=document.getElementById("ft_list");
            var new_element=document.createElement('div');
            new_element.setAttribute('onclick', "delete_div(this);");
            new_element.setAttribute('id', i);
            new_element.appendChild(str);
            my_list.prepend(new_element);
            div[i] = str;
            setCookies();
            i++;
        }
    }
}
