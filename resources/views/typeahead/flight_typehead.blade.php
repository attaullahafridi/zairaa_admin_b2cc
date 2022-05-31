@push('scripts')
  <script>
    $(document).ready(function() {
      // ----------Type head for origion location----------//
      var list_airport_class = $('.typeahead.typeahead_origion');
      var listAirport = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('airport_name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,

        prefetch: {
            url: "{{ url('getAllAirPortCodes') }}",
            // cache: true, //depends on localstorage size
        },
        remote: {
            url: "{{ url('getAllAirPortCodes') }}"+"/"+'%QUERY',
            wildcard: '%QUERY',
        }
      });
      list_airport_class.typeaheadmulti({
          hint: true,
          highlight: true
      },
      {
        name: 'list_airport',
        display: 'code',
        source: listAirport,
        limit: 12,
        templates: {
            empty: [
                '<div class="empty-message">',
                'No record found',
                '</div>'
            ].join('\n'),
            suggestion: function(data) {
              // console.log('suggestion');
              // console.log(data);
                return '<p>' + data.code + ' - '+data.airport_name+'</p>';
            }
        }
      });
      list_airport_class.bind('typeahead:select', function(ev, suggestion) {
        var from_code_value = $('#from_code').val();
        if (from_code_value != '') {
          var plus_the_value = from_code_value +' - '+suggestion.code;
          $('#from_code').val(plus_the_value);
        }
        else{
          $('#from_code').val(suggestion.code);
        }
      });
      var list_airport_class = $('.typeahead.typeahead_destination');
      var listAirport = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('airport_name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,

        prefetch: {
            url: "{{ url('getAllAirPortCodes') }}",
            // cache: true, //depends on localstorage size
        },
        remote: {
            url: "{{ url('getAllAirPortCodes') }}"+"/"+'%QUERY',
            wildcard: '%QUERY',
        }
      });
      list_airport_class.typeaheadmulti({
          hint: true,
          highlight: true
      },
      {
        name: 'list_airport',
        display: 'code',
        source: listAirport,
        limit: 12,
        templates: {
            empty: [
                '<div class="empty-message">',
                'No record found',
                '</div>'
            ].join('\n'),
            suggestion: function(data) {
              // console.log('suggestion');
              // console.log(data);
                return '<p>' + data.code + ' - '+data.airport_name+'</p>';
            }
        }
      });
      list_airport_class.bind('typeahead:select', function(ev, suggestion) {
        var from_code_value = $('#destination_code').val();
        if (from_code_value != '') {
          var plus_the_value = from_code_value +' - '+suggestion.code;
          $('#destination_code').val(plus_the_value);
        }
        else{
          $('#destination_code').val(suggestion.code);
        }
      });
      //------end Document-------//
    });
  </script>
@endpush