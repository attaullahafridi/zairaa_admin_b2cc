@push('scripts')
	<script>
        $(document).ready(function() {
            var list_country_class = $('.typeahead.guest_nationality');
            var listCountries = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                prefetch: {
                    url: "{{ url('GetAllCountries') }}",
                    // cache: true, //depends on localstorage size
                },
                remote: {
                    url: "{{ url('GetAllCountries') }}"+"/"+'%QUERY',
                    wildcard: '%QUERY',
                }
            });

            list_country_class.typeahead({
                    hint: true,
                    highlight: true
                },
                {
                    name: 'list_countries',
                    display: 'name',
                    source: listCountries,
                    limit: 10,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            'No record found',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            return '<p>' + data.name + ' - '+data.code+'</p>';
                        }
                    }
                });
            list_country_class.bind('typeahead:select', function(ev, suggestion) {
                $('#country_code').val(suggestion.code);
            });
        });
	</script>
@endpush