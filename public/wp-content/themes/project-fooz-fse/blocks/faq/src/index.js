import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, RichText, useBlockProps } from '@wordpress/block-editor';

registerBlockType('fooz/faq', {
    edit({ attributes, setAttributes }) {
        const { heading } = attributes;

        return (
            <div {...useBlockProps()}>
                <RichText
                    tagName="h2"
                    value={heading}
                    onChange={(value) => setAttributes({ heading: value })}
                    placeholder="FAQ heading..."
                />

                <div className="accordion">
                    <InnerBlocks
                        allowedBlocks={['fooz/faq-item']}
                        renderAppender={InnerBlocks.ButtonBlockAppender}
                    />
                </div>
            </div>
        );
    },

    save({ attributes }) {
        const { heading } = attributes;

        return (
            <div className="fooz-faq">
                <RichText.Content tagName="h2" value={heading} />
                <div className="accordion">
                    <InnerBlocks.Content />
                </div>
            </div>
        );
    }
});
