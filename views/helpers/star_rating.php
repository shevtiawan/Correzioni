<?php
class StarRatingHelper extends AppHelper {
    function create($id, $url = array(), $selected = 0, $disabled = false) {
        $modelClass = 'ProductRating';
        $options = array(
            1 => 'Very poor',
            2 => 'Not that bad',
            3 => 'Average',
            4 => 'Good',
            5 => 'Perfect'
        );

        $View = ClassRegistry::getObject('View');

        // generate neccessary form
        echo $View->Form->create($modelClass, array(
            'id' => "{$modelClass}Form-{$id}",
            'url' => Router::url($url)
        ));
        echo $View->Form->input('id', array(
            'value' => $id, 'id' => "{$modelClass}Id-{$id}"
        ));
        echo $View->Form->input('average', array(
            'options' => $options,
            'selected' => $selected,
            'label' => false,
            'div' => array('id' => "stars-wrapper-{$id}"),
            'id' => "{$modelClass}Average-{$id}",
            'disabled' => $disabled
        ));
        echo $View->Form->end();

        $js = <<<EOL
<script type="text/javascript">
    $(function() {
        $("#stars-wrapper-{$id}").stars({
            inputType: "select",
            cancelShow: false,
            callback: function(ui, type, value)
            {
                $.post(
                    $("#{$modelClass}Form-{$id}").attr('action'),
                    {id: {$id}, rate: value},
                    function(average) {
                        // average is ajax response from server side
                        // the value is integer
                        // so the amount of star turned on should reflect value of average
                    }
                );
            }
        });
    });
</script>
EOL;

        echo $js;
    }
}
