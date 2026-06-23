$(document).ready(function() {
  if ($('.datatable').length) {
    $('.datatable').DataTable({
      responsive: true,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
      }
    });
  }

  $(document).on('click', '.btn-delete', function() {
    const url = $(this).data('url');
    const title = $(this).data('title');
    $('#deleteModalTitle').text(title);
    $('#deleteForm').attr('action', url);
    $('#deleteModal').modal('show');
  });

  setTimeout(function() {
    $('.alert-auto-dismiss').fadeOut('slow');
  }, 3000);
});
