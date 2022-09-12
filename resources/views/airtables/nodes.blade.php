@foreach($nodes as $key => $node)
    <div style="padding-left: 50px">
        |__ {{ $node['fields']['number'] ?? ''}} : {{ $node['fields']['description'] ?? ''}}
        @if(!empty($node['fields']['children']))
            <div style="padding-left: 50px">
                @include('airtables.nodes', ['nodes' => $node['fields']['children']])
            </div>
        @endif
    </div>

@endforeach
