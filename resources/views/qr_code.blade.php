<!DOCTYPE html>
<html>
<head>
    <title>Product QR Code</title>
</head>
<body>
    @php 
        $arrayName = array(
            'title'=> 'rwqqw',
            'price'=> 23423
        );
    
    @endphp
    
    {{QrCode::size(250)->generate(json_encode($arrayName));}}
</body>
</html>
