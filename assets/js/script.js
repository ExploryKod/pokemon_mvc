import {$} from './common/variables'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)
import { menuBurger } from './components/menuBurger'
import { scrollToId } from './components/scroll'
import { gsapHeaderLinksOnScroll } from './components/gsapAnimScroll'
import { showTabTarget } from "./components/showTabTarget";
import { makeToast } from "./components/toastify";

window.addEventListener('DOMContentLoaded', (event) => {

  try {
    makeToast();
    showTabTarget();
    scrollToId()
    gsapHeaderLinksOnScroll()
    menuBurger()
  } catch(error) {
    console.error(error)
  }

})
