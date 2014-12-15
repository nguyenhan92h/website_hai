/**
 * [onCheckAll description]
 * @return {[type]} [description]
 */
function onCheckAll() {
    var check = document.getElementsByName('chkMasCheck');
    var items = document.getElementsByName('chk');
    if (check[0].checked == true) {
        for (var i = 0; i < items.length; i++) {
            items[i].checked = true;
        }
    } else {
        for (var i = 0; i < items.length; i++) {
            items[i].checked = false;
        }
    }
}

/**
 * [onDelAll description]
 * @param  {[type]} _dr [description]
 * @return {[type]}     [description]
 */
function onDelAll(_dr) {
    var items = document.getElementsByName('chk');
    var arr = '';
    for (var i = 0; i < items.length; i++) {
        if (items[i].checked == true) {
            arr += items[i].value + ",";
        }
    }
    if (arr.length == 0) {
        alert("Bạn chưa chọn trường cần xóa");
    }
    if (arr.length == 1) {
        var listId = arr.substring(0, arr.length - 1);
        if (confirm("Xóa?")) {
            window.location.href = _dr + listId;
        }
    }
    if (arr.length > 1) {
        var listId = arr.substring(0, arr.length - 1);
        if (confirm("Xóa?")) {
            window.location.href = _dr + listId;
        }
    }
}

/**
 * [changeValueCol description]
 * @param  {[type]} id       [description]
 * @param  {[type]} col      [description]
 * @param  {[type]} table    [description]
 * @param  {[type]} val      [description]
 * @param  {[type]} colwhere [description]
 * @return {[type]}          [description]
 */
function changeValueCol(id, col, table, val, colwhere){
    var url = location.protocol + '//' + location.host + '/admin/changevaluecol';
    $.ajax({
        url: url,
        type: "GET",
        data: {id: id, col: col, tbl: table, val: val, colwhere: colwhere},
        success: function(html){
                $("#" + col + id).html(html);
        },
        error:function(){
            $("#" + col + id).html('Lỗi, bạn hãy thử lại');
        }
    });
}