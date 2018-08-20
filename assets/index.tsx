import * as preact from 'preact'

import './index.css'

preact.render((
  <div class="root">
    <span>Hello, world!</span>
    <button onClick={ (e) => alert('hi!') }>Click Me</button>
  </div>
), document.body)
