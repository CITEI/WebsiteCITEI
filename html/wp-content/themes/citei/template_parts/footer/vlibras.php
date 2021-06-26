<?php
/*
Type: Template_part
Name: vlibras
Purpose: Adds vlibras plugin
Author: Nickolas da Rocha Machado & Natalia Zambe

DEPRECATED
Brazilian government bar already includes vlibras
 */
?>
  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>