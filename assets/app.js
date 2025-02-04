/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@picocss/pico/css/pico.min.css'

import 'bootstrap';

import Sparticles from 'sparticles';

new Sparticles(document.body, { count: 100 }, 400);

console.log('Salut mon gars');
