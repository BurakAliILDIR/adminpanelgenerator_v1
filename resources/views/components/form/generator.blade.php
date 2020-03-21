<?php $model = $settings['model']; ?>
@foreach($settings['fields'] as $field)
    @if($field[$settings['operation']])
        <?php
        $name = @$field['name'];
        $title = @$field['title'];
        $id = @$field['id'];
        $value = @$field['value'];
        $attributes = @$field['attributes'];
        ?>

        @switch($field['type'])
            @case('radio')
            @component('components.form.partials.radio',
                       ['id' => $id,
                       'name' => $name,
                       'items' => $field['items'],
                       'checked' => $model[$name],
                       'title' => $title,
                       'attributes' => $attributes,
            ])@endcomponent
            @break
            @case('multi_checkbox')
            @component('components.form.partials.multi_checkbox',
                      ['id' => $id,
                      'name' => $name,
                      'value' => $value ?? $settings['extra'][$name],
                      'checked' => $model->relation($field['relationship'])->get(),
                      'title' => $title,
                      'attributes' => $attributes,
            ])@endcomponent
            @break
            @case('checkbox')
            @component('components.form.partials.checkbox',
                       ['id' => $id,
                       'name' => $name,
                       'checked' => $model[$name],
                       'title' => $title,
                       'attributes' => $attributes,
            ])@endcomponent
            @break
            @case('select')
            @component('components.form.partials.select',
                       ['id' => $id,
                       'name' => $name,
                       'title' => $title,
                       'value' => $value ?? $settings['extra'][$name],
                       'selected' => $model[$field['relationship']['keys']['otherKey']],
                       'attributes' => $attributes,
            ])@endcomponent
            @break
            @case('password')
            @component('components.form.partials.password',
                       ['id' => $id,
                       'name' => $name,
                       'title' => $title,
                       'attributes' => $attributes,
            ])@endcomponent
            @break
            @case('file')
            @case('image')
            @component('components.form.partials.file',
                       ['id' => $id,
                       'type' => $field['type'],
                       'name' => $name,
                       'value' => $model->getFirstMediaUrl($name) === "" ? $value : $model->getFirstMediaUrl($name),
                       'title' => $title,
                       'attributes' => $attributes,
            ])@endcomponent
            @break
            @case('hidden')
            @component('components.form.partials.hidden',
                       ['id' => $id,
                       'name' => $name,
                       'value' => $model[$name]
            ])@endcomponent
            @break
            @default
            @component('components.form.partials.' . $field['type'],
                       ['id' => $id,
                       'name' => $name,
                       'title' => $title,
                       'value' => $model[$name],
                       'attributes' => $attributes,
            ])@endcomponent
            @break
        @endswitch
    @endif
@endforeach
