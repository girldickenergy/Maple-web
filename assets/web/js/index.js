<script>
function changePricing()
{
    if ($("#cheatradio-0").is(':checked'))
        $("#0-pricing").removeAttr('hidden');
    else
        $("#0-pricing").attr('hidden', true);

    if ($("#cheatradio-1").is(':checked'))
        $("#1-pricing").removeAttr('hidden');
    else
        $("#1-pricing").attr('hidden', true);
}

$("#cheatradio-0").change(function () {
    changePricing();
});
$("#cheatradio-1").change(function () {
    changePricing();
});
</script>