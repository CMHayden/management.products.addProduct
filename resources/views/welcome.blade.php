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

        <h1>Add products | <a href="https://requestbin.com/r/entpebyij95/1OBSTNBoEbRuaCVgDbR67yZMCqZ">Request Bin</a></h1>
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

            /*
                Test Data:
                487545	V-Neck T-Shirt	€4.50
                487546	Chinos	€15
                487547	Jeans	€12.50
                487548	ACDC T-Shirt	€7.50
                487549	Metallica T-Shirt	€7.50
            */

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
                document.getElementById("store-api").addEventListener('click', function() {
                    var exportedString = hot.getPlugin("exportFile").exportAsString('csv', {
                    bom: true,
                    columnDelimiter: ',',
                    columnHeaders: false,
                    exportHiddenColumns: true,
                    exportHiddenRows: true,
                    mimeType: 'text/csv',
                    rowDelimiter: '\r\n',
                    rowHeaders: true
                    });

                    let input = hot.getData();
                    let i = 0;
                    let j = 1;

                    while (input[i] != null) {

                        if (input[i][0] == null || input[i][1] == null || input[i][2] == null || input[i][0] == "" || input[i][1] == "" || input[i][2] == "" ){
                            alert("Invalid entry in row " + j + ". All previous rows stored");
                            return 0;
                        }

                        const headers = new Headers()
                        headers.append("Content-Type", "application/json")

                        const body = {
                            "SKU": input[i][0],
                            "Description": input[i][1],
                            "Price": input[i][2]
                        }

                        const options = {
                        method: "POST",
                        headers,
                        mode: "cors",
                        body: JSON.stringify(body),
                        }

                        fetch("https://entpebyij95.x.pipedream.net/", options)

                        i++
                        j++
                    }

                    console.log("Success! This is the data sent to request bin: ");
                    console.log(hot.getData());

                });
            }
        </script>
    </body>
</html>

