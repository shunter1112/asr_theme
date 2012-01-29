<?php get_header();?>
<?php get_sidebar(); ?>
<div id="Contents">
  
  <div id="Post" class="object">
  <h1>ArtLayer</h1>
  <div class="description">
    An object within a document that contains the visual elements of the image (equivalent to a layer in the Adobe Photoshop CS5 application).
    Access an art layer in a document through the Document.artLayers collection. You can access a layer by name; for example:
    var layerRef = app.activeDocument.artLayers.getByName("my layer"); layerRef.allLocked = true;
    Access the art layers in a layer set through the LayerSet.artLayers collection in the parent set.
  </div>
  
  <div class="properties">
  <h2>Properties</h2>
  <table>
    <tr>
      <th class="name"> Property </th>
      <th class="type"> Value type</th>
      <th class="description"> Description </th>
    </tr>
    <tr>
      <td class="name">allLocked</td>
      <td class="type">boolean</td>
      <td class="description">booleanRead-write. True to completely lock the contents and settings of this layer.</td>
    </tr>  
    <tr>
      <td class="name">blendMode</td>
      <td class="type">BlendMode</td>
      <td class="description">￼Read-write. The blending mode.</td>
    </tr>  
    <tr>
      <td class="name">bounds</td>
      <td class="type">array of UnitValue</td>
      <td class="description">Read-only. An array of coordinates that describes the bounding rectangle of the layer.</td>
    </tr>  
    <tr>
      <td class="name">fillOpacity</td>
      <td class="type">number [0.0..100]</td>
      <td class="description">Read-write. The interior opacity of the layer, a percentage value.</td>
    </tr>  
  </table>
  </div>
  
  <div class="methods">
  <h2>Methods</h2>
  <table>
    <tr>
      <th class="name"> Methods </th>
      <th class="type"> Value type </th>
      <th class="returns"> Returns </th>
      <th class="description"> Description </th>
    </tr>
    <tr>
      <td class="name"> adjustBrightnessContrast (brightness, contrast) </td>
      <td class="type"> number, number </td>
      <td class="returns"> </td>
      <td class="description"> Adjusts the brightness in the range [-100..100] and contrast [-100..100]. </td>
    </tr>
    <tr>
      <td class="name"> adjustColorBalance ([shadows] [, midtones] [, highlights] [, preserveLuminosity])</td>
      <td class="type"> array of number, array of number, array of number, boolean </td>
      <td class="returns"> </td>
      <td class="description"> Adjusts the color balance of the layer’s component channels. For shadows, midtones, and highlights, the array must include three values in the range [-100..100], which represent cyan or red, magenta or green, and yellow or blue, when the document mode is CMYK or RGB. </td>
    </tr>
    <tr>
      <td class="name"> adjustCurves (curveShape) </td>
      <td class="type"> array of array of number </td>
      <td class="returns"> </td>
      <td class="description"> Adjusts the tonal range of the selected channel using up to fourteen points.
      Each value in the curveShape array is a point pair, an array of an x and y integer value. </td>
    </tr>
    <tr>
      <td class="name"> adjustLevels (inputRangeStart, inputRangeEnd, inputRangeGamma, outputRangeStart, outputRangeEnd) </td>
      <td class="type"> number [0..253], number [(start + 2)..255], number [0.10..9.99], number [0..253], number [(start + 2)..255] </td>
      <td class="returns"> </td>
      <td class="description"> Adjusts the levels of the selected channels </td>
    </tr>
  </table>
  </div>
  
  <div class="sample_codes">
    <pre>
      // Save the current preferences
      var startRulerUnits = app.preferences.rulerUnits var startTypeUnits = app.preferences.typeUnits var startDisplayDialogs = app.displayDialogs
      // Set Adobe Photoshop CS5 to use pixels and display no dialogs app.preferences.rulerUnits = Units.PIXELS app.preferences.typeUnits = TypeUnits.PIXELS app.displayDialogs = DialogModes.NO
      //Close all the open documents while (app.documents.length) {
         app.activeDocument.close()
      }
      // Create a new document to merge all the samples into
      var mergedDoc = app.documents.add(1000, 1000, 72, "Merged Samples", NewDocumentMode.RGB, DocumentFill.TRANSPARENT, 1)
      // Use the path to the application and append the samples folder var samplesFolder = Folder(app.path + "/Samples/")
      //Get all the files in the folder
      var fileList = samplesFolder.getFiles()
      // open each file
      for (var i = 0; i < fileList.length; i++) {
      // The fileList is folders and files so open only files if (fileList[i] instanceof File) {
               open(fileList[i])
      // use the document name for the layer name in the merged document var docName = app.activeDocument.name
      // flatten the document so we get everything and then copy app.activeDocument.flatten() app.activeDocument.selection.selectAll() app.activeDocument.selection.copy()
      // don’t save anything we did app.activeDocument.close(SaveOptions.DONOTSAVECHANGES)
      // make a random selection on the document to paste into // by dividing the document up in 4 quadrants and pasting // into one of them by selecting that area
      var topLeftH = Math.floor(Math.random() * 2)
      var topLeftV = Math.floor(Math.random() * 2)
      var docH = app.activeDocument.width.value / 2
      var docV = app.activeDocument.height.value / 2
      var selRegion = Array(Array(topLeftH * docH, topLeftV * docV),
      Array(topLeftH * docH + docH, topLeftV * docV), Array(topLeftH * docH + docH, topLeftV * docV + docV), Array(topLeftH * docH, topLeftV * docV + docV), Array(topLeftH * docH, topLeftV * docV))
               app.activeDocument.selection.select(selRegion)
               app.activeDocument.paste()
      // change the layer name and opacity app.activeDocument.activeLayer.name = docName app.activeDocument.activeLayer.fillOpacity = 50
      JavaScript Scripting Reference
      JavaScript Object Reference 66
      Adobe Photoshop CS5
      ￼￼} }
      // sort the layers by name
      for (var x = 0; x < app.activeDocument.layers.length; x++) {
      for (var y = 0; y < app.activeDocument.layers.length - 1 - x; y++) { // Compare in a non-case sensitive way
      var doc1 = app.activeDocument.layers[y].name
      var doc2 = app.activeDocument.layers[y + 1].name
      } }
      }
      if (doc1.toUpperCase() > doc2.toUpperCase()) { app.activeDocument.layers[y].move(app.activeDocument.layers[y+1],
             ElementPlacement.PLACEAFTER)
      // Reset the application preferences app.preferences.rulerUnits = startRulerUnits app.preferences.typeUnits = startTypeUnits app.displayDialogs = startDisplayDialogs
    </pre>
  </div>
  
</div>
<?php get_footer();?>
