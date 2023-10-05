// 現在いるURLのタブのCSSを変更
$(function() {
    // 指定したクラスを持つ要素をループ処理
    $('.category_select').each(function(){
        // 取得した要素のhref属性値を取得
        let href = $(this).attr('href');
        // 取得した要素のhref属性値と現在のURLが同じなら処理を行う
        if(location.href == href) {
            // クラスを削除
            $(this).removeClass('bg-theme-sub');
            // クラスを追加
            $(this).addClass('bg-theme-main text-white');
        }
    });
});
    