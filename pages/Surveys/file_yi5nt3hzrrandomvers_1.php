'<!DOCTYPE html>
<html>
<body>

<p>Click the button to display the seconds of the time right now.</p>

<button onclick="myFunction()">Try it</button>

<p id="demo"></p>

<script>
function myFunction() {
    var d = new Date();
    var n = d.getSeconds();
    document.getElementById("demo").innerHTML = n;
}
</script>

</body>
</html>
'