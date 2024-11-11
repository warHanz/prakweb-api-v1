<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    import React from 'react';
    import ReactDOM from 'react-dom';

    export default function HelloReact() {
    return (
    <h1>Hello React!</h1>
    );
    }

    if (document.getElementById('hello-react')) {
    ReactDOM.render(
    <HelloReact />, document.getElementById('hello-react'));
    }
</body>

</html>
