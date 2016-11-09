<!-- If there are some errors, they will be shown here -->

@if (count($errors) > 0)
    <div class="alert alert-danger">
        {{ Html::ul($errors->all()) }}
    </div>
@endif