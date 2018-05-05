var deleteModal = $('#delete-confirmation-modal');

deleteModal.on('click', '.confirm', function(e) {

    var $modalDiv = $(e.delegateTarget);
    var id = $(this).data('recordId');
    var entity = $(this).data('entityType');
    deleteEntity(id, entity);

});

deleteModal.on('show.bs.modal', function(e) {

    var data = $(e.relatedTarget).data();
    $('.confirm', this).data('recordId', data.recordId);
    $('.confirm', this).data('entityType', data.entityType);

});

function deleteEntity(id, entity) {
    $.ajax({
        type: 'DELETE',
        url: '/api/'+entity+'/delete',
        data: {id: id},
        dataType: 'json',
        success: function ()
        {
            window.location.reload();
        }
    });
}