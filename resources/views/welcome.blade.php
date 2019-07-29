<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>management.products</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.css">
        <link rel="stylesheet" type="text/css" href="https://handsontable.com/static/css/main.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <style>
            h1, p {
                text-align: center;
            }

            .center-align-handsontable {
                width: 1100px;
                margin: auto;
            }
        </style>
    </head>
    <body onload="table()">

        <h1>Add products | <a href="https://requestbin.com/r/entpebyij95/1OBSTNBoEbRuaCVgDbR67yZMCqZ">Request Bin</a></h1>
        <p>Add a new product using the table below</p>

        <div class="center-align-handsontable">
            <div id="hot"></div>
            <div id="export-buttons" class="visible">
                <button id="export-csv" class="btn size-medium bg-blue text-white shadow hover-moveup" style="margin-right: 5px;">Export as .csv</button>
                <button id="store-api" class="btn size-medium bg-green text-white shadow hover-moveup">Send to API</button>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.js"></script>
        <script>

            function table(){
                var hotElement = document.querySelector('#hot');
                var hotElementContainer = hotElement.parentNode;
                var hotSettings = {
                    columns: [
                    {
                        data: 'ProductName',
                        type: 'text',
                        width: 60
                    },
                    {
                        data: 'ProductModel',
                        type: 'text',
                        width: 60
                    },
                    {
                        data: 'Description',
                        type: 'text'
                    },
                    {
                        data: 'SKU',
                        type: 'numeric',
                        width: 40
                    },
                    {
                        data: 'Price',
                        type: 'numeric',
                        width: 40
                    }

                    ],
                    stretchH: 'all',
                    width: 1037,
                    autoWrapRow: true,
                    manualRowResize: true,
                    manualColumnResize: true,
                    height: 300,
                    rowHeaders: true,
                    colHeaders: [
                    'Name',
                    'Model',
                    'Description',
                    'SKU',
                    'Price'
                    ],
                    dropdownMenu: true,
                    exportFile: true,
                    contextMenu: true
                };
                    var hot = new Handsontable(hotElement, hotSettings);
                    document.getElementById("export-csv").addEventListener("click", function(event) { hot.getPlugin("exportFile").downloadFile("csv", {filename: "product.management.addProdcut"});})

                    document.getElementById("store-api").addEventListener('click', function() {


                    const headers = new Headers()
                    headers.append("Content-Type", "application/json")

                    const body = hot.getData();

                    const options = {
                        method: "POST",
                        headers,
                        mode: "cors",
                        body: JSON.stringify(body),
                        }
                        fetch("/api/products", options)

                        console.log(hot.getData());
                        console.log(JSON.stringify(hot.getData()));

                    });

                };

        </script>
    </body>
</html>

