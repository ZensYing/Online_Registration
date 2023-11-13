// $(document).ready(function () {
//     $('#search').on('input', function () {
//         var searchTerm = $(this).val();
//         if (searchTerm.length > 2) {
//             $.ajax({
//                 url: 'PersonalInformation.php',
//                 type: 'GET',
//                 data: { query: searchTerm },
//                 success: function (response) {
//                     $('#search-results').html(response).show();
//                 },
//                 error: function () {
//                     $('#search-results').html('<div class="p-2">Error fetching search results.</div>').show();
//                 },
//             });
//         } else {
//             $('#search-results').html('').hide();
//         }
//     });

  
//     $('body').click(function (event) {
//         if (!$(event.target).closest('#search').length && !$(event.target).closest('#search-results').length) {
//             $('#search-results').hide();
//         }
//     });
// });