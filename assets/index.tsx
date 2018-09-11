import * as hyper from 'hyperapp'

import styles from './index.css'

const initialState = {
  count: 0,
}

const baseActions = {
  down: (value) => (state) => ({ count: state.count - value }),
  up: (value) => (state) => ({ count: state.count + value }),
}

const view = (state, actions) => (
  <div className={styles.root}>
    <h1>{state.count}</h1>
    <button onclick={() => actions.down(1)}>-</button>
    <button onclick={() => actions.up(1)}>+</button>
  </div>
)

hyper.app(initialState, baseActions, view, document.body)
