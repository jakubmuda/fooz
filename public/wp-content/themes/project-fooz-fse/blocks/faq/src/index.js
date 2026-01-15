import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, RichText, useBlockProps } from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';

registerBlockType('fooz/faq', {
    edit({ attributes, setAttributes, clientId }) {
        const { heading, blockId } = attributes;

        useEffect(() => {
            if (!blockId) {
                setAttributes({ blockId: clientId });
            }
        }, []);

        return (
            <div
                {...useBlockProps({
                    'data-faq-id': blockId,
                })}
            >
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
        const { heading, blockId } = attributes;

        return (
            <div
                className="fooz-faq"
                data-faq-id={blockId}
            >
                <RichText.Content tagName="h2" value={heading} />
                <div className="accordion">
                    <InnerBlocks.Content />
                </div>
            </div>
        );
    }
});
