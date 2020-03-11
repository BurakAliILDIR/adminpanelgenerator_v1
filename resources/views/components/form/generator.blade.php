@foreach($settings['fields'] as $field)
    @if($field[$settings['operation']])
        @switch($field['type'])
            @case('radio')
            @component('components.form.radio',
                       ['id' => $field['id'],
                       'name' => $field['name'],
                       'value' => $field['value'],
                       'checked' => $settings['model'][$field['name']],
                       'title' => $field['title'],
                       'attributes' => @$field['attributes'],
            ])@endcomponent
            @break
            @case('multi_checkbox')
            @component('components.form.multi_checkbox',
                      ['id' => $field['id'],
                      'name' => $field['name'],
                      'value' => $field['value'] ?? $settings['extra'][$field['name']],
                      'checked' => $settings['model']->relation($field['relationship'])->get(),
                      'title' => $field['title'],
                      'attributes' => @$field['attributes'],
            ])@endcomponent
            @break
            @case('checkbox')
            @component('components.form.checkbox',
                       ['id' => $field['id'],
                       'name' => $field['name'],
                       'checked' => $settings['model'][$field['name']],
                       'title' => $field['title'],
                       'attributes' => @$field['attributes'],
            ])@endcomponent
            @break
            @case('select')
            @component('components.form.select',
                       ['id' => $field['id'],
                       'name' => $field['name'],
                       'title' => $field['title'],
                       'value' => $field['value'] ?? $settings['extra'][$field['name']],
                       'selected' => $settings['model'][$field['name']],
                       'attributes' => @$field['attributes'],
            ])@endcomponent
            @break
            @case('password')
            @component('components.form.password',
                       ['id' => $field['id'],
                       'name' => $field['name'],
                       'title' => $field['title'],
                       'attributes' => @$field['attributes'],
            ])@endcomponent
            @break
            @case('file')
            @component('components.form.file',
                       ['id' => $field['id'],
                       'name' => $field['name'],
                       'title' => $field['title'],
                       'attributes' => @$field['attributes'],
            ])@endcomponent
            @break
            @case('hidden')
            @component('components.form.hidden',
                       ['id' => $field['id'],
                       'name' => $field['name'],
                       'value' => $settings['model'][$field['name']]
            ])@endcomponent
            @break
            @default
            @component('components.form.' . $field['type'],
                       ['id' => $field['id'],
                       'name' => $field['name'],
                       'title' => $field['title'],
                       'value' => $settings['model'][$field['name']],
                       'attributes' => @$field['attributes'],
            ])@endcomponent
            @break
        @endswitch
    @endif
@endforeach
