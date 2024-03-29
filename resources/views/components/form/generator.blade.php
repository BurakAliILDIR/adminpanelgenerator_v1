@component('components.alert.alert_messages')@endcomponent
@component('components.alert.error_messages')@endcomponent
<?php $model = $settings['model']; ?>
@foreach($settings['fields'] as $key => $field)
    <?php
    $title = @$field['title'];
    $value = @$field['value'];
    $items = @$field['items'];
    $attributes = @$field['attributes'];
    ?>

    @switch($field['type'])
      @case('radio')
      @component('components.form.partials.radio',
                 ['key' => $key,
                 'items' => $items,
                 'checked' => $model[$key],
                 'title' => $title,
                 'attributes' => $attributes,
      ])@endcomponent
      @break
      @case('multi_checkbox')
      @case('multi_select')
      @component('components.form.partials.' . $field['type'],
                ['key' => $key,
                'value' => $settings['plucks'][$key],
                'checked' => $model->relation($field['relationship'])->get(),
                'title' => $title,
                'attributes' => $attributes,
      ])@endcomponent
      @break
      @case('checkbox')
      @component('components.form.partials.checkbox',
                 ['key' => $key,
                 'checked' => $model[$key],
                 'title' => $title,
                 'label' => @$field['label'],
                 'attributes' => $attributes,
      ])@endcomponent
      @break
      @case('select')
      @component('components.form.partials.select',
                 ['key' => $key,
                 'title' => $title,
                 'items' => $items ?? $settings['plucks'][$key],
                 'selected' => $model[$key],
                 'attributes' => $attributes,
      ])@endcomponent
      @break
      @case('password')
      @component('components.form.partials.password',
                 ['key' => $key,
                 'title' => $title,
                 'attributes' => $attributes,
      ])@endcomponent
      @break
      @case('date')
      @case('datetime')
      @component('components.form.partials.' . $field['type'],
                 ['key' => $key,
                 'title' => $title,
                 'value' => $model[$key],
                 'attributes' => $attributes,
      ])@endcomponent
      @break
      @case('file')
      @component('components.form.partials.file',
                 ['key' => $key,
                 'value' => $model->getFirstMediaUrl($key),
                 'title' => $title,
                 'attributes' => $attributes,
      ])@endcomponent
      @break
      @case('image')
      @component('components.form.partials.image',
                 ['key' => $key,
                 'value' => $model->getFirstMediaUrl($key),
                 'title' => $title,
                 'attributes' => $attributes,
      ])@endcomponent
      @break
      @case('hidden')
      @component('components.form.partials.hidden',
                 ['key' => $key,
                 'value' => $model[$key] ?? $value
      ])@endcomponent
      @break
      @case('auth')
      @break
      @default
      @component('components.form.partials.' . $field['type'],
                 ['key' => $key,
                 'title' => $title,
                 'attributes' => $attributes,
      ])@endcomponent
      @break
    @endswitch
@endforeach
