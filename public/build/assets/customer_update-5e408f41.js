$("#customer_update_enter").on("click",function(){window.confirm("荷主を更新しますか？")==!0&&$("#customer_update_form").submit()});$("#customer_delete_enter").on("click",function(){window.confirm(`荷主を削除しますか？
※進捗データも同時に削除されるのでご注意下さい。`)==!0&&$("#customer_delete_form").submit()});
