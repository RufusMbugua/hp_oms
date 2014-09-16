<script>
$(function () {
var dataSource = <?php echo $dataSource;?>;

$("#<?php echo $container?>").dxChart({
    dataSource: dataSource,
  
    series: <?php echo $series;?>,
    argumentAxis:{
        grid:{
            visible: false
        }
    },
    tooltip:{
        enabled: true,
        customizeText: function(value){
            return value.valueText +' in '+ value.argumentText;
        }
    },
     title: {
        text: <?php echo $title?>,
        verticalAlignment: 'bottom',
        font: {
                color: '#3276b1',
                family: 'SourceSansPro-Regular',
                opacity: 0.75,
                size: 16,
                weight: 200
            }
    },
    legend: {
        verticalAlignment: "bottom",
        horizontalAlignment: "center"
    },
    commonPaneSettings: {
        border:{
            visible: false,
            right: false
        }       
    }
});
});
</script>
<div id="<?php echo $container?>" class="graph" style="height:100%">
	
</div>