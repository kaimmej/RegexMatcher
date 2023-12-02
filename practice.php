<!DOCTYPE>
<html lang="en>
<head>
    <meta charset="UTF-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge>
    <meta name="viewport content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        const xhtpp = new XMLHttpRequest();
        xhtpp.open('GET','https://jsonplaceholder.typicode.com/users');
        xhtpp.send();

        // we need to handle the response
        // on ready state change 
        // this gets called every time the ready state is changed. 
        xhtpp.onreadystatechange = () => {
            if(xhtpp.readyState === 4 && xhtpp.status === 200){  // if its a 4, means the operation is complete! 
                console.log('Operation Completed sucessfully!');
                document.write(xhtpp.response);
            } 

        }
    </script>
</body>
</html>