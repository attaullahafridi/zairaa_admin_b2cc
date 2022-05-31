@push('scripts')
	<script>
        $(document).ready(function() {
            var list_cities_class = $('.typeahead.transfer_pick_up');
            var listCities = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                prefetch: {
                    url: "{{ url('typeaheadtransfer') }}",
                    // cache: true, //depends on localstorage size
                },
                remote: {
                    url: "{{ url('typeaheadtransfer') }}"+"/"+'%QUERY',
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
                            console.log(data);
                            return '<p>' + data.name +'</p>';
                        }
                    }
                });
            list_cities_class.bind('typeahead:select', function(ev, suggestion) {
                $('#pickup_location_name').val(suggestion.name);
                $('#pickup_location').val(suggestion.id);
            });

            var list_cities_class = $('.typeahead.transfer_drop_of');
            var listCities = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                prefetch: {
                    url: "{{ url('typeaheadtransfer') }}",
                    // cache: true, //depends on localstorage size
                },
                remote: {
                    url: "{{ url('typeaheadtransfer') }}"+"/"+'%QUERY',
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
                            console.log(data);
                            return '<p>' + data.name +'</p>';
                        }
                    }
                });
            list_cities_class.bind('typeahead:select', function(ev, suggestion) {
                $('#dropoff_location_name').val(suggestion.name);
                $('#dropoff_location').val(suggestion.id);
            });
        });
	</script>
@endpush