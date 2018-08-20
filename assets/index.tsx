import * as preact from 'preact'

import styles from './index.css'

preact.render((
  <div class={styles.root}>
    <span>Hello, world!</span>
    <button onClick={ (e) => alert('hi!') }>Click Me</button>
  </div>
), document.body)
