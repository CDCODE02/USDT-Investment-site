// function myfunction() {
    

//         /*Get the text field */
//         var copyText = document.getElementById("myInput")

//         /*select d text field */
//         copyText.Select();
//         copyText.setSelectionRange(0, 9999); /*for mobile devices*/

//         //copy d text inside d text field
//         navigator.clipboard.writeText(copyText.value);

//         //alert d copied text
//         alert("Copied the text: " + copyText.value); 
//     }

function myeadd() {
    

    /*Get the text field */
    var copyText = document.getElementById("myetadd");

    /*select d text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*for mobile devices*/

    
    //copy d text inside d text field
    navigator.clipboard.writeText(copyText.value);
        navigator.clipboard.writeText(copyText.value);

    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copied: " + copyText.value; 
}

function mybadd() {
    

    /*Get the text field */
    var AddText = document.getElementById("myadd");

    /*select d text field */
    AddText.select();
    AddText.setSelectionRange(0, 99999); /*for mobile devices*/

    
    //copy d text inside d text field
    navigator.clipboard.writeText(AddText.value);
        navigator.clipboard.writeText(AddText.value);

    // var tooltip = document.getElementById("myadd");
    // tooltip.innerHTML = "Copied: " + AddText.value; 
}

function mynadd() {
    

    /*Get the text field */
    var AddText = document.getElementById("mybnadd");

    /*select d text field */
    AddText.select();
    AddText.setSelectionRange(0, 99999); /*for mobile devices*/

    
    //copy d text inside d text field
    navigator.clipboard.writeText(AddText.value);
        navigator.clipboard.writeText(AddText.value);

    // var tooltip = document.getElementById("myadd");
    // tooltip.innerHTML = "Copied: " + AddText.value; 
}

function myuadd() {
    

    /*Get the text field */
    var AddText = document.getElementById("myusadd");
    /*select d text field */
    AddText.select();
    AddText.setSelectionRange(0, 99999); /*for mobile devices*/

    
    //copy d text inside d text field
    navigator.clipboard.writeText(AddText.value);
        navigator.clipboard.writeText(AddText.value);
   
    // var tooltip = document.getElementById("myadd");
    // tooltip.innerHTML = "Copied: " + AddText.value; 
}



function outFunc()
{
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copy to clipboard";
}