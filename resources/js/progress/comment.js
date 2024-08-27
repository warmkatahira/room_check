// 編集が押下されたら
$('.comment_update').on("click",function(){
    // 情報を取得
    const customer_code = $(this).data('customer-code');
    const comment = $(this).data('comment');
    // モーダルを開く
    $('#comment_modal').removeClass('hidden');
    // モーダルに情報を出力
    $('#customer_code').val(customer_code);
    $('#comment').val(comment);
});

// 閉じるが押下されたら
$('#comment_modal_close').on("click",function(){
    // モーダルを閉じる
    $('#comment_modal').addClass('hidden');
});

// 更新が押下されたら
$('#comment_update_enter').on("click",function(){
    try {
        // コメントが50文字以内であるか確認
        if($('#comment').val().length > 50){
            throw new Error('コメントは50文字以内で入力して下さい。');
        }
        var ajax_url = '/customer/ajax_comment_update';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ajax_url,
            type: 'POST',
            data: {
                customer_code: $('#customer_code').val(),
                comment: $('#comment').val(),
            },
            dataType: 'json',
            success: function(data){
                location.reload();
            },
            error: function(){
                alert('失敗');
            }
        });
    } catch (e) {
        alert(e.message);
    }
});