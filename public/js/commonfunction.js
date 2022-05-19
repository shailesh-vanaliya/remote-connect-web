var Toastr = function() {
    return {
        init: function(type, title, message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-center",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr[type](message, title);
        }
    };
}();

function ajaxcall(url, data, callback) {
    //  App.startPageLoading();
    var rtrn = $.ajax({
        type: 'POST', url: url, data: data,
        success: function(result) {
            //   App.stopPageLoading();
            callback(result);
        }
    });
    return rtrn;
}

function handleAjaxFormSubmit(form, type) {
    if (typeof type === 'undefined') {
        ajaxcall($(form).attr('action'), $(form).serialize(), function(output) {
            handleAjaxResponse(output);
        });
    } else if (type === true) {
        // App.startPageLoading();
        var options = {
            resetForm: false, // reset the form after successful submit
            success: function(output) {
                //   App.stopPageLoading();
                handleAjaxResponse(output);
            }
        };
        $(form).ajaxSubmit(options);
    }
    return false;
}

function showToster(status, message) {
    toastr.options = {closeButton: true, progressBar: true, showMethod: 'slideDown', timeOut: 4000};

    if (status == 'success') {
        toastr.success(message, 'Success');
    }
    if (status == 'error') {
        toastr.error(message, 'Fail');
    }
}

function handleAjaxResponse(output) {
    output = JSON.parse(output);

    if (output.message != '') {
        showToster(output.status, output.message, '');
    }

    if (typeof output.redirect !== 'undefined' && output.redirect != '') {
        setTimeout(function() {
            window.location.href = output.redirect;
        }, 4000);
    }

    if (typeof output.jscode !== 'undefined' && output.jscode != '') {
        eval(output.jscode);
    }
}

function handleFormValidate(form, rules, submitCallback, showToaster, noScroll) {
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: ":hidden",
        rules: rules,
        invalidHandler: function(event, validator) { //display error alert on form submit
            success.hide();
            error.show();
//            App.scrollTo(error, -200);
            if (typeof showToaster !== 'undefined' && showToaster) {
                Toastr.init('warning', 'Some fields are missing!.', '');
            }
        },
        showErrors: function(errorMap, errorList) {
            if (typeof errorList[0] != "undefined") {
                var position = $(errorList[0].element).offset().top - 70;
                if (typeof noScroll !== 'undefined') {
                    if (!noScroll) {
                        $('html, body').animate({scrollTop: position}, 300);
                    }
                }
            }
            this.defaultShowErrors(); // keep error messages next to each input element
        },
        highlight: function(element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function(element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function(label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        },
        errorPlacement: function(error, element) {
            return true;
        },
        submitHandler: function(form) {
            if (typeof submitCallback !== 'undefined' && typeof submitCallback == 'function') {
                submitCallback(form);
            } else {
                handleAjaxFormSubmit(form);
            }
            return false;
        }
    });

    $('.select2me', form).change(function() {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });
    $('.date-picker .form-control').change(function() {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });
}

function handleFormValidateNew(form, rules, showToaster, noScroll) {
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: ":hidden",
        rules: rules,
        invalidHandler: function(event, validator) { //display error alert on form submit
            success.hide();
            error.show();
            //App.scrollTo(error, -200);
            if (typeof showToaster !== 'undefined' && showToaster) {
                Toastr.init('warning', 'Some fields are missing!.', '');
            }
        },
        showErrors: function(errorMap, errorList) {
            if (typeof errorList[0] != "undefined") {
                var position = $(errorList[0].element).offset().top - 70;
                if (typeof noScroll == 'undefined') {
                    if (!noScroll) {
                        $('html, body').animate({scrollTop: position}, 300);
                    }
                }
            }
            this.defaultShowErrors(); // keep error messages next to each input element
        },
        highlight: function(element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            console.log('1');
        },
        unhighlight: function(element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function(label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        },
        errorPlacement: function(error, element) {
            //return true;
        }
    });

    $('.select2me', form).change(function() {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });
    $('.date-picker .form-control').change(function() {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });
}

//------------------------------------------------------------------------------------------------------
function loadingStart(that) {
    console.log("xxxxxx")
    that.parent().find('.loader').append('<img src="/ICON/loading.gif">');
}

function loadingEnd(that) {
    that.parent().find('.loader').html('');
}

function newLoadingStart(that) {
    that.parent().find('.defaultLoader').append('<img src="/ICON/load.gif"> <span class="loading-text">Loading</div>');
}

function newLoadingEnd(that) {
    that.parent().find('.defaultLoader').html('');
}

$(".closeIcon").click(function() {
    $("#errorSection").slideUp(0);
});

$(document).ready(function() {
    hideMsgBox();
});

function hideMsgBox() {
    setTimeout(function() {
        $("#errorSection").slideUp(3000);
    }, 5000);
}

/* Display Timepicker */
function timeFormate(field) {
    $(field).timepicker({
        showInputs: false
    });
}

/* Delete Single Record & Redirect */
function deleteSingleData(URL, parentID) {
    $('body').on('click', '.delete', function() {
        var dataid = $(this).attr('data-id');
        $('.yes-sure').attr('data-id', dataid);
    });

    $('.yes-sure').click(function() {
        var dataid = $(this).attr('data-id');
        //alert(parentID)
        if (parentID) {
            window.location = (URL + parentID + '/' + dataid);
        } else {
            window.location = (URL + dataid);
        }
    });
}

/* Date Validation */
function checkDateRangeOLD(classOrID, startDateID, endDateID, msg) {
    $(classOrID).change(function() {
        var OldFormateOfStartDate = $(startDateID).val();

        var splitDate = OldFormateOfStartDate.split(/\D/);
        var startDate = splitDate.reverse().join('-');

        if (endDateID === 'today') {
            var today = new Date();
            if ((Date.parse(startDate) >= Date.parse(today))) {
                if (msg) {
                    alert(msg);
                } else {
                    alert("Date Must be Greater from Today");
                }
                $(startDateID).val('');
            }
        } else {
            var OldEndDate = $(endDateID).val();
            if (OldEndDate != '') {
                var splitEndDate = OldEndDate.split(/\D/);
                var endDate = splitEndDate.reverse().join('-');

                if ((Date.parse(startDate) >= Date.parse(endDate))) {
                    if (msg) {
                        alert(msg);
                    } else {
                        alert("Date Finish Must be after Date Start");
                    }
                    $(endDateID).val('');
                }
            }
        }
    });
}

function checkDateRange(classOrID, startDateID, endDateID, msg) {

    $(classOrID).change(function() {

        var today = new Date();
        if (endDateID === 'today') {
            var startDate = reverseDate(startDateID);
            if ((Date.parse(startDate) >= Date.parse(today))) {
                if (msg) {
                    alert(msg);
                } else {
                    alert("Date Must be Less from Today");
                }
                $(startDate).val('');
            }
        } else if (startDateID === 'today') {
            var endDate = reverseDate(endDateID);
            if ((Date.parse(endDate) <= Date.parse(today))) {
                if (msg) {
                    alert(msg);
                } else {
                    alert("Date Must be Greater from Today");
                }
                $(endDateID).val('');
            }
        } else {
            var startDate = reverseDate(startDateID);
            var endDate = reverseDate(endDateID);

            if (startDate != '' && endDate != '') {
                if ((Date.parse(startDate) >= Date.parse(endDate))) {
                    if (msg) {
                        alert(msg);
                    } else {
                        alert("Date Finish Must be after Date Start");
                    }
                    $(endDateID).val('');
                }
            }
        }
    });
}

/* Remove Error class & Error Msg */
function removeError(field) {

    if ((typeof field === 'undefined') || (field == '')) {
        $("body").find('input').removeClass("error");
        $("body").find('label[class="error"]').remove();
    } else {
        $(field).find('input').removeClass("error");
        $(field).find('label[class="error"]').remove();
    }

}

function restrictNumeric(field) {
//    alert('123')
    $(field).keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
}

function alphaOnly(field) {

    $(field).keypress(function(e) {
        var charTyped = String.fromCharCode(e.which);
        if (e.which == 8) { // 8 for backspace or delete
            return true;
        } else if (/^[a-zA-Z]+$/i.test(charTyped)) {
            return true;
        } else {
            return false;
        }
    });
}


function ajaxAction(url, action, postData, callback) {
    $.ajax({
        type: "POST", url: site_url + url,
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        data: {'action': action, 'data': postData},
        success: function(data) {
            callback(data);
        },
        error: function(err) {
        }
    });
}


function sessionDisplayMessage(status, msg) {
    $('#errorSection').show();
    $('#errorSection').html('<div class="col-md-12 margin-t-30"><div class="alert ' + status + '">' + msg + '<div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div></div></div>');
    $('html,body').animate({scrollTop: $(".content").offset().top}, 'slow');
    //$('html,body').animate({scrollTop: $(".content-header").offset().top}, 'slow');
    hideMsgBox();
}

function noRecordFound(value, field) {
    if (value > 0) {
        $(field).hide();
    } else {
        $(field).show();
    }
}

function noRecordFoundNew(placeId, value, colSpanVal) {
    if (value > 0) {

    } else {
        var tbodyData = '<tr>' +
                '<td colspan="' + colSpanVal + '" style="text-align: center">' +
                '<p style="color:red;">Sorry, No Record Found</p>' +
                '</td>' +
                '</tr>';
        $(placeId).html(tbodyData);
    }
}


function initAccord(formId, step, stepId, stepClass, nxtButton) {

    $("body").on("click", 'a[data-parent="#' + stepId + '"]', function() {
        if ($($(this).attr('href')).hasClass('in')) {
            return false;
        } else {
            var condition = ($(this).data('order') == $('a[href="#' + $('.' + stepClass + '.in').attr('id') + '"]').data('order') + 1);
            if (condition) {
                var valid = $(formId).valid();
                if (!valid) {
                    return false;
                }
            } else if ($(this).data('order') > $('a[href="#' + $('.' + stepClass + '.in').attr('id') + '"]').data('order')) {
                return false;
            }
        }
    });

    if (typeof nxtButton !== 'undefined') {
        $("body").on("click", '.' + nxtButton, function() {
            //$("#saveExit" + step).val('0');

            var valid = ($(formId).valid()) ? true : false;
            var elem = $("." + stepClass + ".in").closest('.panel').next('.panel').find('a[data-parent="#' + stepId + '"]');

            if (elem.length > 0 && valid) {
                elem.trigger('click');
            }
            if (valid) {
                var condition = ($("a[data-parent='#" + stepId + "'][data-order='" + $("a[data-parent='#" + stepId + "']").length + "']").hasClass('active'));

                if (condition) {
                    $(formId).submit();
                }
            }
        });
    }

    $("body").on("shown.bs.collapse", "#" + stepId, function() {
        $("a[data-parent='#" + stepId + "']").removeClass('active');
        $("a[data-parent='#" + stepId + "']").parent('h4').parent('div').removeClass('active');
        $("a[data-parent='#" + stepId + "'][aria-expanded='true']").addClass('active');
        $("a[data-parent='#" + stepId + "'][aria-expanded='true']").parent('h4').parent('div').addClass('active');

        $('.detail-btn-next').show();
        $('.saveExitBtn').hide();

        if ($("a[data-parent='#" + stepId + "']").last().hasClass('active')) {
            $('.detail-btn-next').hide();
            $('.saveExitBtn').show();
        }
    });

    $("body").on("hidden.bs.collapse", "#" + stepId + "", function() {
        $("a[data-parent='#" + stepId + "']").removeClass('active');
        $("a[data-parent='#" + stepId + "']").parent('h4').parent('div').removeClass('active');
        $("a[data-parent='#" + stepId + "'][aria-expanded='true']").addClass('active');
        $("a[data-parent='#" + stepId + "'][aria-expanded='true']").parent('h4').parent('div').addClass('active');

        $('.detail-btn-next').show();
        $('.saveExitBtn').hide();

        if ($("a[data-parent='#" + stepId + "']").last().hasClass('active')) {
            $('.detail-btn-next').hide();
            $('.saveExitBtn').show();
        }
    });
}
;

jQuery(document).ready(function() {
    fileinput();
});

function fileinput() {

    var inputs = document.querySelectorAll('.inputfile');
    Array.prototype.forEach.call(inputs, function(input)
    {

        var label = input.nextElementSibling,
                labelVal = label.innerHTML;

        input.addEventListener('change', function(e)
        {
            var fileName = '';
            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                label.querySelector('span').innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener('focus', function() {
            input.classList.add('has-focus');
        });
        input.addEventListener('blur', function() {
            input.classList.remove('has-focus');
        });
    });
}

/* Start manage datatable with Ajax & hide/show column dynamic */

function getDataTable(arr) {

    var dataTable = $(arr.tableID).DataTable({
        //"scrollY": "200px",
        "processing": true,
        "serverSide": true,
        "bAutoWidth": false,
        "bLengthChange": false,
        "bInfo": false,
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search..."
        },
        "order": [[(arr.defaultSortColumn) ? arr.defaultSortColumn : '0', (arr.defaultSortOrder) ? arr.defaultSortOrder : 'desc']],
        "columnDefs": [
            {
                "targets": arr.hideColumnList,
                "visible": false
            },
            {
                "targets": arr.noSortingApply,
                "orderable": false
            },
            {
                "targets": arr.noSearchApply,
                "searchable": false
            },
            (arr.setColumnWidth) ? arr.setColumnWidth : ''
        ],
        "ajax": {
            url: arr.ajaxURL,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: {'action': arr.ajaxAction, 'data': arr.postData},
            error: function() {  // error handling
                $(".row-list-error").html("");
                $(arr.tableID).append('<tbody class="row-list-error"><tr><td colspan="4" style="text-align: center;"><p style="color:red;">Sorry, No Record Found</p></td></tr></tbody>');
                $(arr.tableID + "processing").css("display", "none");
            }
        }
    });

    onLoadDefaultColumnSet(dataTable);
    hideShowDatatableColumn(dataTable);
}

function getDataTableSpe(arr) {

    var dataTable = $(arr.tableID).DataTable({
        //"scrollY": "200px",
        "processing": true,
        "serverSide": true,
        "bAutoWidth": false,
        "bLengthChange": false,
        "bInfo": false,
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search..."
        },
        "order": [[(arr.defaultSortColumn) ? arr.defaultSortColumn : '0', (arr.defaultSortOrder) ? arr.defaultSortOrder : 'desc']],
        "columnDefs": [
            {
                "targets": arr.hideColumnList,
                "visible": false
            },
            {
                "targets": arr.noSortingApply,
                "orderable": false
            },
            {
                "targets": arr.noSearchApply,
                "searchable": false
            },
            (arr.setColumnWidth) ? arr.setColumnWidth : ''
        ],
        "ajax": {
            url: arr.ajaxURL,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: {'action': arr.ajaxAction, 'data': arr.postData},
            error: function() {  // error handling
                $(".row-list-error").html("");
                $(arr.tableID).append('<tbody class="row-list-error"><tr><td colspan="4" style="text-align: center;"><p style="color:red;">Sorry, No Record Found</p></td></tr></tbody>');
                $(arr.tableID + "processing").css("display", "none");
            },
        },
        initComplete: function() {

            var count = 0;
            this.api().columns().every(function() {
                var column = this;
//                    Chetan Changes Starting 20-08-2018
                if (count == 5) {
//                    console.log($(column.header()).find('.dd').html());
                    var select5 = $(column.header()).find('.statusf').on('click', function() {
//                            var val = $.fn.dataTable.util.escapeRegex(
//                                $(this).val()
//                            );
                        var val = [];

                        $.each($("input[name='status']:checked"), function() {
                            val.push($(this).val());
                        });

                        column.search(val ? val : '', true, false).draw();
                    });
//                    var select5 = $('<select class="form-control footerStatus"><option value="">All Status</option></select>')
//                        .appendTo( $(column.footer()).empty() )
//                        .on( 'change', function () {
//                            var val = $.fn.dataTable.util.escapeRegex(
//                                $(this).val()
//                            );
//                            column.search( val ? val : '', true, false ).draw();
//                    } );
//                    select5.append('<option value="In Application">New Application Request</option><option value="Reconsider">Reconsider</option><option value="Rejected">Rejected</option><option value="Offered">Offered</option><option value="Pending">Pending</option>');
                }
                count++;
            });
        }
    });
//        Chetan Changes END 20-08-2018
    onLoadDefaultColumnSet(dataTable);
    hideShowDatatableColumn(dataTable);
}

function onLoadDefaultColumnSet(dataTable) {
    $('.custom-column').each(function() {
        var column = dataTable.column($(this).attr('data-column'));
        var status = $(this).attr('data-default-status');

        if ($(this).is(":checked")) {
            column.visible(!column.visible());
        } else {
            column.visible(column.visible());
        }
        if (status == 'true') {
            column.visible(!column.visible());
        }
    });
}

function hideShowDatatableColumn(dataTable) {
    $('body').on('click', '.custom-column', function() {
        // Get the column API object
        var column = dataTable.column($(this).attr('data-column'));
        // Toggle the visibility
        column.visible(!column.visible());
    });
}

/* End manage datatable with Ajax & hide/show column dynamic */

$(".dropdown-toggle-column").click(function() {
    $('.column-navbar').addClass('open-nav-option');
});
$(".main-conntent").mouseup(function(e)
{
    var subject = $(".dropdown-menu");
    if (e.target.id != subject.attr('class') && !subject.has(e.target).length)
    {
        $('.column-navbar').removeClass('open-nav-option');
    }
});
