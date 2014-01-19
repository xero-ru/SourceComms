<?php
/* @var $this CommsController */
/* @var $model Comms */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comms-form',
	'action'=>isset($action) ? $action : null,
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'inputContainer'=>'.control-group',
		'validateOnSubmit'=>true,
        'afterValidateAttribute' => 'js:function(form, attribute, data, hasError) {
            var to_update;
            switch (attribute.name) {
                case "steam":
                    to_update = "type";
                    break;

                case "type":
                    to_update = "steam";
                    break;
            }
            $.each($.fn.yiiactiveform.getSettings(form).attributes, function () {
                if (this.name == to_update && this.status !== 2 && this.status !== 3) {
                    $.fn.yiiactiveform.updateInput(this, data, form);
                }
            });
        }',
    ),
    'errorMessageCssClass'=>'help-inline',
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'enctype'=>'multipart/form-data',
    ),
)) ?>

  <div class="control-group">
    <?php echo $form->labelEx($model,'name',array('class' => 'control-label')); ?>
    <div class="controls">
      <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
      <?php echo $form->error($model,'name'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->label($model,'steam',array('class' => 'control-label', 'required' => true)); ?>
    <div class="controls">
      <?php echo $form->textField($model,'steam',array('size'=>32,'maxlength'=>32)); ?>
      <?php echo $form->error($model,'steam'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->label($model,'type',array('class' => 'control-label')); ?>
    <div class="controls">
      <?php echo $form->dropDownList($model,'type',Comms::getTypes()); ?>
      <?php echo $form->error($model,'type'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'reason',array('class' => 'control-label')); ?>
    <div class="controls">
      <?php echo $form->textArea($model,'reason',array('size'=>60,'maxlength'=>255)); ?>
      <?php echo $form->error($model,'reason'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->label($model,'length',array('class' => 'control-label')); ?>
    <div class="controls">
      <?php echo $form->dropDownList($model,'length',SBBan::getTimes()); ?>
      <?php echo $form->error($model,'length'); ?>
    </div>
  </div>


  <div class="control-group buttons">
    <div class="controls">
      <?php echo CHtml::submitButton(Yii::t('sourcebans', 'Save'),array('class' => 'btn')); ?>
    </div>
  </div>

<?php $this->endWidget() ?>