<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>management.products</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.css">
        <link rel="stylesheet" type="text/css" href="https://handsontable.com/static/css/main.css">

        <style>
            h1, p {
                text-align: center;
            }

            .center-align-handsontable {
                width: 900px;
                margin: auto;
            }
        </style>
    </head>
    <body onload="table()">

        <h1>Add products</h1>
        <p>Add a new product using the table below</p>

        <div class="center-align-handsontable">
            <div id="hot"></div>
            <div id="export-buttons" class="visible">
                <button id="export-csv" class="btn size-medium bg-blue text-white shadow hover-moveup" style="margin-right: 5px;">Export as .csv</button>
                <button id="store-api" class="btn size-medium bg-green text-white shadow hover-moveup">Store in API</button>
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
                        data: 'sku',
                        type: 'numeric',
                        width: 40
                    },
                    {
                        data: 'description',
                        type: 'text'
                    },
                    {
                        data: 'price',
                        type: 'text'
                    }

                    ],
                    stretchH: 'all',
                    width: 837,
                    autoWrapRow: true,
                    height: 300,
                    maxRows: 22,
                    rowHeaders: true,
                    colHeaders: [
                    'SKU',
                    'Description',
                    'Price'
                    ],
                    exportFile: true
                };
                var hot = new Handsontable(hotElement, hotSettings);
                document.getElementById("export-csv").addEventListener("click", function(event) { hot.getPlugin("exportFile").downloadFile("csv", {filename: "product.management.addProdcut"});})
                document.getElementById("store-api").addEventListener("click", function(event) {console.log(hot.getPlugin("exportFile").exportAsString("csv"));})
            }

        </script>
    </body>
</html>

