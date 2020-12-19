import {registerBlockType} from '@wordpress/blocks';
import {Button,} from '@wordpress/components';
import {
    RichText,
    BlockControls
} from '@wordpress/block-editor';

registerBlockType('frontify/dam', {
    title: 'Frontify Media Library Image',
    icon: 'format-image',
    category: 'embed',
    example: {},
    edit: (props) => {
        const {
            className,
            attributes: {
                base_url,
                api_token,
                title,
                caption,
                asset_url,
                hide_chooser
            },
            setAttributes,
        } = props;

        const openChooser = () => {
            setAttributes({ hide_chooser: false });
        };

        const closeChooser = () => {
            setAttributes({ hide_chooser: true });
        };

        const updateCaption = (value) => {
            setAttributes({ caption: value });
        };

        const manageFrame = (frame) => {
            if (!frame) { return; }
            let chooser  = frame.contentWindow;
            // cross document messaging
            window.addEventListener('message', e => {
                if (!e.data) {
                    return;
                }

                if (e.data.error) {
                    closeChooser();
                } else if (e.data.configurationRequested) {
                    chooser.postMessage(
                        {
                            token: api_token,
                            mode: 'tree',
                            multiSelectionAllowed: false
                        },
                        base_url
                    );
                } else if (e.data.assetsChosen) {
                    setAttributes({
                        caption: e.data.assetsChosen[0].title,
                        asset_url: e.data.assetsChosen[0].generic_url.replace('{width}', '800'),
                        title: e.data.assetsChosen[0].title,
                        hide_chooser: true
                    });
                } else if (e.data.aborted) {
                    closeChooser();
                }
            });
        };

        return (
            <div class={className}>
                {
                    asset_url && (
                        <div>
                            <BlockControls>
                                <div class="components-toolbar">
                                    <Button isTertiary onClick={openChooser}>Replace</Button>
                                </div>
                            </BlockControls>
                            <figure>
                                <img src={asset_url} alt={title} title={title} />
                                <RichText
                                    tagName="figcaption"
                                    placeholder="Image Caption"
                                    value={caption}
                                    onChange={updateCaption}
                                />
                            </figure>
                        </div>
                    )
                }
                {
                    !asset_url && (
                        <Button isPrimary onClick={openChooser}>Choose Asset</Button>
                    )
                }
                {
                    !hide_chooser && (
                        <div class="frontify-asset-chooser">
                            <iframe src={base_url} height={700} ref={manageFrame} />
                        </div>
                    )
                }
            </div>
        )
    },
    save(props) {
        const {
            className,
            attributes: {
                title,
                caption,
                asset_url
            }
        } = props;
        return (
            <div className={className}>
                {
                    asset_url && (
                        <figure className={className}>
                            <img src={asset_url} alt={title} title={title} />
                            {
                                caption && (
                                    <RichText.Content tagName="figcaption" value={caption} />
                                )
                            }
                        </figure>
                    )
                }
            </div>
        );
    },
});