<!DOCTYPE html>
<html>
<head>
    <title>Product QR Code</title>
</head>
<body>
    <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="Product QR Code">
</body>
</html>
