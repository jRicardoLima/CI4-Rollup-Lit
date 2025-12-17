import { LitElement, html, css } from 'lit';
import { customElement } from 'lit/decorators.js';

@customElement('x-hello')
export class XHello extends LitElement {
    static styles = css`
    :host { display: block; padding: 12px; border: 1px solid #ddd; border-radius: 8px; }
  `;

    render() {
        return html`<div>Hello World CI4 + ROLLUP + LIT</div>`;
    }
}