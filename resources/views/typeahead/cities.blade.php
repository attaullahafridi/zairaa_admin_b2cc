@push('scripts')
	<script>
        $(document).ready(function() {
            var list_cities_class = $('.typeahead.cities');
            var listCities = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                prefetch: {
                    url: "{{ url('GetAllCities') }}",
                    // cache: true, //depends on localstorage size
                },
                remote: {
                    url: "{{ url('GetAllCities') }}"+"/"+'%QUERY',
                    wildcard: '%QUERY',
                }
            });

            list_cities_class.typeahead({
                    hint: true,
                    highlight: true
                },
                {
                    name: 'list_cities',
                    display: 'name',
                    source: listCities,
                    limit: 10,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            'No record found',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            return '<p>' + data.name + ' - '+data.countrycode+'</p>';
                        }
                    }
                });
            list_cities_class.bind('typeahead:select', function(ev, suggestion) {
                $('#code').val(suggestion.code);
            });

            var list_cities_class = $('.typeahead.activity_cities');
            var listCities = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                prefetch: {
                    url: "{{ url('GetAllCities') }}",
                    // cache: true, //depends on localstorage size
                },
                remote: {
                    url: "{{ url('GetAllCities') }}"+"/"+'%QUERY',
                    wildcard: '%QUERY',
                }
            });

            list_cities_class.typeahead({
                    hint: true,
                    highlight: true
                },
                {
                    name: 'list_cities',
                    display: 'name',
                    source: listCities,
                    limit: 10,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            'No record found',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            return '<p>' + data.name + ' - '+data.countrycode+'</p>';
                        }
                    }
                });
            list_cities_class.bind('typeahead:select', function(ev, suggestion) {
                $('#activity_code').val(suggestion.code);
            });
        });
	</script>
@endpush