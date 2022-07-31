<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
     .tooltip{
         position: relative;
         display: inline-block;
     }    

     .tooltip .tooltiptext{
         visibility: hidden;
         width: 140px;
         background-color: #555;
            color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        z-index: 1;
        bottom:150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
     }

     .tooltip .tooltiptext::after{
         content: "";
         position: absolute;
         top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent
        transparent transparent;

     }

     .tooltip:hover .tooltiptext{
         visibility: visible;
         opacity: 1;
     }
    </style>
</head>
<body>
    
    <p>Click on the button to copy the text from the text field. Try to paste the text (e.g ctrl+v) afterwards in a different window, to see the effect</p>

     <input type="text" value="ddddddddddddddddddddd" id="myInput">

     <div class="tooltip">
     <button onclick="myFunction()" onmouseout="outFunc()">
     <span class="tooltiptext" id="myTooltip">
     Copy to clipboard
     </span>
     Copy text
     </button>
     </div>

     <script>
     function myFunction() {
         var copyText = document.getElementById("myInput");
         copyText.select();
         copyText.setSelectionRange(0, 99999);

         navigator.clipboard.writeText(copyText.value);

         var tooltip = document.getElementById("myTooltip");
         tooltip.innerHTML = "Copied: " + copyText.value;
     }

     function outFunc(){
         var tooltip = document.getElementById("myTooltip");
         tooltip.innerHTML = "Copy to clipboard";
     }
     </script>
</body>
</html>