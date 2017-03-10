<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is display the custom feed configuration part of the metabox on feed edit screen.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Rex_Product_Feed
 * @subpackage Rex_Product_Feed/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="rex-feed-config">
  <table id="config-table">
    <thead>
      <tr>
        <th>Attributes</th>
        <th>Type</th>
        <th>Value</th>
        <th>Prefix</th>
        <th>Suffix</th>
        <th>Output Sanitization</th>
        <th>Output Limit</th>
        <th></th>
      </tr>
    </thead>

    <tbody>

    <?php foreach ( $gt->getTemplateMappings() as $key => $item): ?>
      <tr data-row-id="<?php echo $key; ?>">
        <td><?php $gt->printSelectDropdown( $key, 'attributes', $item['attr'] ); ?></td>
        <td><?php $gt->printAttType( $key, $item['type'] ); ?></td>
        <td>

          <div class="meta-dropdown">
            <?php $gt->printSelectDropdown( $key, 'meta_key', $item['meta_key'] ); ?>
          </div>

          <div class="static-input">
            <?php $gt->printInput( $key, 'st_value', $item['st_value'] ); ?>
          </div>

        </td>
        <td><?php $gt->printInput( $key, 'prefix', $item['prefix'] ); ?></td>
        <td><?php $gt->printInput( $key, 'suffix', $item['suffix'] ); ?></td>
        <td><?php $gt->printSelectDropdown( $key, 'escape', $item['escape'] ); ?></td>
        <td><?php $gt->printInput( $key, 'limit', $item['limit'] ); ?></td>
        <td><a class="button delete">Delete</a></td>
      </tr>
    <?php endforeach ?>

    </tbody>

  </table>
  <a id="rex-new-attr" class="button">Add New Attribute</a>

</div>
