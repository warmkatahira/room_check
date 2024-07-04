$(document).ready(function() {
    // selectタグが変更された時のイベント処理
    $('#search_customer_code').change(function() {
        $('#search_form').submit();
    });
});