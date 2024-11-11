$(".select_file input[type=file]").on("change",function(){window.confirm("ログのチェックを実行しますか？")==!0&&$("#log_check_form").submit(),$(".select_file").val(null)});
