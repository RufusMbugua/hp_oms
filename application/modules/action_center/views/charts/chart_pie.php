<script>
$(function () {
var dataSource = <?php echo $dataSource;?>;

$("#<?php echo $container;?>").dxPieChart({
  
    dataSource: dataSource,
    commonSeriesSettings: {
        label: {
            visible: true,
            connector: {
                visible: true
            },
            customizeText: function(value){
            	return value.argumentText ;
        	}
        }        
        //...
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
    series: <?php echo $series;?>,
    tooltip:{
        enabled: true,
        customizeText: function(value){
            return value.argumentText+' : ' +value.percentText;
        }
    },
    legend: {
        visible:false
   	}
});
});
</script>
<div id="<?php echo $container;?>" class="graph" style="height:100%">
	
</div>