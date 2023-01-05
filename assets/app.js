/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// any CSS
import 'datatables.net-dt/css/jquery.dataTables.min.css';
import 'datatables.net-searchbuilder-dt/css/searchBuilder.dataTables.min.css';

import '@fortawesome/fontawesome-free/css/all.css';

// import script js for bootstrap
import bootstrap from 'bootstrap/dist/js/bootstrap';



// require jQuery normally & set to the global scope
import $ from 'jquery';
window.$ = $;

import 'datatables.net-dt/js/dataTables.dataTables.min';
import 'datatables.net-searchbuilder-dt/js/searchBuilder.dataTables.min';

$('#table_leaves').DataTable();