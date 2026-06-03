import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';
import Currency from './currency';

window.Alpine = Alpine;
window.Currency = Currency;

Alpine.start();