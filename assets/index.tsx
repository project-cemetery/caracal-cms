import * as preact from 'preact'

import { css } from 'emotion'

const root = css({
  color: 'red',
})

const f = () => {
    return 'ok'
}

preact.render((
  <div class={root}>
    <span>Hello, world!</span>
    <button onClick={ (e) => alert('hi!') }>Click Me</button>
  </div>
), document.body)
